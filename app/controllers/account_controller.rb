
require "ldap"
require "time"
require "yaml"

class AccountController < ApplicationController
  # Be sure to include AuthenticationSystem in Application Controller instead
  include AuthenticatedSystem
  # If you want "remember me" functionality, add this before_filter to Application Controller
  before_filter :login_from_cookie

  # say something nice, you goof!  something sweet.
  def index
    redirect_to(:action => 'signup') unless logged_in? || User.count > 0
  end

  def login
    return unless request.post?
    self.current_user = authenticate(params[:login], params[:password])
    if logged_in?
      if params[:remember_me] == "1"
        self.current_user.remember_me
        cookies[:auth_token] = { :value => self.current_user.remember_token , :expires => self.current_user.remember_token_expires_at }
      end
      redirect_back_or_default(:controller => '/account', :action => 'index')
      flash[:notice] = "Logged in successfully"
    end
  end
  
  def logout
    self.current_user.forget_me if logged_in?
    cookies.delete :auth_token
    reset_session
    flash[:notice] = "You have been logged out."
    redirect_back_or_default(:controller => '/account', :action => 'index')
  end

	def authenticate(login, password)
    auth = Authenticator.new
		auth.initialization()
		u = auth.authenticate(login, password)
		u
  end

	class Authenticator
		connection = nil
		host = nil
		port = nil
		domain = nil
		dn = nil

		def initialization()
			config = YAML::load(File.open("#{RAILS_ROOT}/config/active_directory.yml"))
			@host = config["host"]
			@port = config["port"]
			@domain = config["domain"]
			@dn = config["dn"]
		end

		def authenticate(login, password)
			db_user = User.find_by_login(login)
			begin
				email = login + "@" + @domain
				connection = LDAP::Conn.new(@host, @port)
				connection.set_option( LDAP::LDAP_OPT_PROTOCOL_VERSION, 3 )
				connection.bind( email, password )
				connection.search( @dn, LDAP::LDAP_SCOPE_SUBTREE, "sAMAccountName=#{login}") do |ad_user|
					if db_user == nil
						db_user = User.new
					end
					db_user.login = login
					db_user.email = email
					db_user.display_name = ad_user.vals("displayName").to_s
					db_user.given_name = ad_user.vals("givenName").to_s
					db_user.last_login_at = Time.new
					db_user.save
				end
				
				@connection = connection
				db_user
			rescue => e
				puts e
				nil
			end
		end

		def close
			@connection.unbind unless @connection == nil
			@connection = nil
		end
	end
end
