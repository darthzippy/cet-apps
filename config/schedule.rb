# Use this file to easily define all of your cron jobs.
#
# It's helpful, but not entirely necessary to understand cron before proceeding.
# http://en.wikipedia.org/wiki/Cron

# Example:
#
# set :cron_log, "/path/to/my/cron_log.log"
#
# every 2.hours do
#   command "/usr/bin/some_great_command"
#   runner "MyModel.some_method"
#   rake "some:great:rake:task"
# end
#
# every 4.days do
#   runner "AnotherModel.prune_old_records"
# end

# Learn more: http://github.com/javan/whenever

every 1.day, :at => '7:00 am' do
  rake "db:backup RAILS_ENV=production"
  rake "utils:upload_backup RAILS_ENV=production"
  rake "utils:bb:course_combine RAILS_ENV=production"
  rake "utils:bb:course_combine_summer RAILS_ENV=production"
  rake "utils:wco:update_users RAILS_ENV=production"
end