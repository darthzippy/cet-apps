class CetUsersController < ApplicationController
  
  layout 'application'
  
  before_filter :login_required
  
  # GET /cet_users
  # GET /cet_users.xml
  def index
    @cet_users = CetUser.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @cet_users }
    end
  end

  # GET /cet_users/1
  # GET /cet_users/1.xml
  def show
    @cet_user = CetUser.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @cet_users }
    end
  end

  # GET /cet_users/new
  # GET /cet_users/new.xml
  def new
    @cet_user = CetUser.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @cet_users }
    end
  end

  # GET /cet_users/1/edit
  def edit
    @cet_user = CetUser.find(params[:id])
  end

  # POST /cet_users
  # POST /cet_users.xml
  def create
    @cet_user = CetUser.new(params[:cet_users])

    respond_to do |format|
      if @cet_user.save
        flash[:notice] = 'CetUsers was successfully created.'
        format.html { redirect_to(@cet_user) }
        format.xml  { render :xml => @cet_user, :status => :created, :location => @cet_user }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @cet_user.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /cet_users/1
  # PUT /cet_users/1.xml
  def update
    @cet_user = CetUser.find(params[:id])

    respond_to do |format|
      if @cet_user.update_attributes(params[:cet_users])
        flash[:notice] = 'CetUsers was successfully updated.'
        format.html { redirect_to(@cet_user) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @cet_user.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /cet_users/1
  # DELETE /cet_users/1.xml
  def destroy
    @cet_user = CetUser.find(params[:id])
    @cet_user.destroy

    respond_to do |format|
      format.html { redirect_to(cet_users_url) }
      format.xml  { head :ok }
    end
  end
end
