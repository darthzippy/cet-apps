set :application, "apps-test"

# If you aren't using Subversion to manage your source code, specify
# your SCM below:
set :scm, :git
set :scm_command, "/usr/local/bin/git"
set :repository,  "git://github.com/darthzippy/cet-apps.git"
set :branch, "master"
set :deploy_to,   "/Library/WebServer/#{application}"
set :deploy_via,  :remote_cache

set :scm_username, "darthzippy"
set :scm_password, "Hermione1"

ssh_options[:forward_agent] = true
# If you aren't deploying to /u/apps/#{application} on the target
# servers (which is the default), you can specify the actual location
# via the :deploy_to variable:
# set :deploy_to, "/var/www/#{application}"



role :app, "cetserv.gordon.edu"
role :web, "cetserv.gordon.edu"
role :db,  "cetserv.gordon.edu", :primary => true

set :mongrel_cmd, "/usr/bin/mongrel_rails_persist"
set :mongrel_ports, 4000..4003

set :user, "eric"
set :group, "admin"

task :initialize_gems do
  'rake gems:install'
end

namespace :deploy do
  
  desc "Start Mongrel processes and add them to launchd."
  task :start, :roles => :app do
    mongrel_ports.each do |port|
      sudo "#{mongrel_cmd} start -p #{port} -e production --prefix /apps --user #{user} --group #{group} -c #{current_path}"
    end  
  end
  
  desc "Stop Mongrels processes and remove them from launchd."
  task :stop, :roles => :app do
    mongrel_ports.each do |port|
      sudo "#{mongrel_cmd} stop -p #{port}"
    end  
  end
  
  desc "Restart Mongrel processes"
  task :restart, :roles => :app do
    stop
    start
  end  
    
end

default_run_options[:pty] = true