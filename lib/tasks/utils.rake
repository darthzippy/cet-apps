require 'config/environment'
require 'fastercsv'

namespace :utils do
    
  desktop = "/Users/ericgivens/Desktop"
  folder = "/Volumes/cet"
  lib = "/Users/ericgivens/Desktop/cet-apps/lib"
  
  desc "Create a connection to NAS1"
  task :nas_login do
    user = "eric.givens"
    pass = "Hermione1"
    nas1 = "nas1/cet"
    
    if File.exists?(folder)
      puts "#{folder} already mounted"
    else
      puts "Connecting to #{nas1} as #{user}"
      Dir.mkdir "/Volumes/cet"
      sh "mount_smbfs //#{user}:#{pass}@#{nas1} #{folder}"
    end
  end
  
  namespace :bb do
    
    desc "Download Blackboard files"
    task :download => :nas_login do
      src = "#{folder}/Blackboard/Blackboard_Export_Roles_Students.csv"
      dest = "#{lib}/bb"
      File.cp(src, dest)
      puts "Blackboard files copied to lib/bb folder"
    end
    
    desc "Run course combine script"
    task :course_combine => :download do
      
    end   
 
  end #namespace :bb
  
  namespace :wco do
    
    desc "Copy Webcheckout file to lib folder"  
    task :copy_file => :nas_login do
      src = "#{folder}/WebCheckout/webcheckout_export.txt"
      dest = "#{lib}/wco/users.txt"
      File.cp(src, dest)
      puts "webcheckout_export.txt copied to lib folder"
    end

    desc "Import Users from Webcheckout CSV file"
    task :update_users => :copy_file do
      quotes_option = "--fields-optionally-enclosed-by='\"'"
      sh "mysqlimport -u root --local cet_apps_development /Users/ericgivens/Desktop/cet-apps/lib/wco/users.txt --verbose #{quotes_option} --fields-terminated-by=',' --columns=id,role,first,middle,last,building,room,on_campus,state,country,zip,email,phone,blank1,barcode,blank2,department,active,updated_at --delete"
    end   
     
  end #namespace :wco
  
end