# Rails.root/config.ru
require "./config/environment"
 
use Rails::Rack::LogTailer
run ActionController::Dispatcher.new