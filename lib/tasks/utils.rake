#require 'config/environment'


namespace :utils do
  
  desc "Move Status to CStatus"
  task :move_cstatus => :environment do
    s = Computer.all
    s.each do |v|
      v.update_attribute(:cstatus,v.status)
      puts "Computer #{v.control} status changed to #{v.cstatus}"
    end
  end

  folder = "/Volumes/cet"
  lib = "/Library/WebServer/apps/current/lib"
  
  desc "Create a connection to NAS2"
  task :nas_login => :environment do
    user = "eric.givens"
    pass = "Winifred1"
    nas2 = "nas2/departments/cet"
    
    if File.exists?(folder)
      puts "#{folder} already mounted"
    else
      puts "Connecting to #{nas2} as #{user}"
      Dir.mkdir "/Volumes/cet"
      sh "mount_smbfs //#{user}:#{pass}@#{nas2} #{folder}"
    end
  end
  
  desc "Upload daily db backup to NAS2"
  task :upload_backup => :nas_login do
    src = "/Library/WebServer/apps/current/db/backup/."
    dest = "#{folder}/CETSERV/CET Apps Daily DB backup"
    
    FileUtils.cp_r(src, dest)
    puts "Daily database backup file uploaded to NAS2"
  end
  
  namespace :bb do
    
    desc "Download Blackboard files"
    task :download_next => :nas_login do
      src = "#{folder}/Blackboard/Blackboard_NextSession_Export_Roles_Students.csv"
      dest = "#{lib}/bb"
      File.cp(src, dest)
      puts "Blackboard files copied to lib/bb folder"
    end
    
    desc "Run course combine script"
    task :course_combine_next => :download_next do
      src = "#{lib}/bb/Blackboard_NextSession_Export_Roles_Students.csv"
      dest = "#{folder}/Blackboard/Blackboard_NextSession_Export_Roles_Students-COMBINED.csv"
      
      @courses = Course.all
      
      File.open(src, "r+") do |file|  
        lines = file.readlines
        
        @courses.each do |course|
          puts "Substituting #{course.destination} for #{course.source}..."
          lines.each do |line|
            line.gsub!(/#{course.source.upcase}/, course.destination.upcase)
          end
        end
        
        file.pos = 0
        file.print lines
        file.truncate(file.pos)
      end
      
      File.cp(src, dest)
      puts "Combined Bb enrollment file uploaded to NAS2"
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