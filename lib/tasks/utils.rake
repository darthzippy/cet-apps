#require 'config/environment'

namespace :utils do

  folder = "/Volumes/cet"
  lib = "/Library/WebServer/apps/current/lib"
  
  desc "Create a connection to NAS1"
  task :nas_login => :environment do
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
    
#    desc "Run course combine script"
#    task :course_combine => :download do
#      sh "sh #{lib}/bb/bb_enroll_09FA.sh"
#      src = "#{lib}/bb/Blackboard_Export_Roles_Students.csv"
#      dest = "#{folder}/Blackboard/Blackboard_Export_Roles_Students-COMBINED.csv"
#      File.cp(src, dest)
#      puts "Combined Bb enrollment file uploaded to NAS1"
#    end
    
    desc "Run NEW course combine script"
    task :course_combine => :download do
      src = "#{lib}/bb/Blackboard_Export_Roles_Students.csv"
      dest = "#{folder}/Blackboard/Blackboard_Export_Roles_Students-COMBINED.csv"
      
      File.open(src, "r+") do |file|
        @courses = Course.all
        lines = file.readlines
        
        @courses.each do |course|
          lines.each do |line|
            line.gsub!(/#{course.source.upcase}/, course.destination.upcase)
          end
        end
        
        file.pos = 0
        file.print lines
        file.truncate(file.pos)
      end
      
      File.cp(src, dest)
      puts "Combined Bb enrollment file uploaded to NAS1"
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
      sh "mysqlimport -u root --local cet_apps_production #{lib}/wco/users.txt --verbose #{quotes_option} --fields-terminated-by=',' --columns=id,role,first,middle,last,building,room,on_campus,state,country,zip,email,phone,blank1,barcode,blank2,department,active,updated_at --delete"
    end   
     
  end #namespace :wco
  
end