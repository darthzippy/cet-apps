set :application, "apps"
set :user, "eric"
set :group, "admin"

set :runner, "root"

# If you aren't using Subversion to manage your source code, specify
# your SCM below:
set :scm, :git
set :scm_command, "/usr/local/bin/git"
set :repository,  "git://github.com/darthzippy/cet-apps.git"
set :branch, "master"
set :deploy_to,   "/Library/WebServer/#{application}"
set :deploy_via,  :remote_cache
set :use_sudo, false
set :git_enable_submodules, 1

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

task :initialize_gems do
  'rake gems:install'
end

default_run_options[:pty] = true

namespace :deploy do
  desc "Restart Application"
  task :restart, :roles => :app do
    run "touch #{current_path}/tmp/restart.txt"
  end
  
  desc "Update the crontab file"
  task :update_crontab, :roles => :db do
    run "cd #{current_path} && whenever"
  end
end

after "deploy", "deploy:cleanup"
after "deploy:cleanup", "deploy:update_crontab"