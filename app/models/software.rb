class Software < ActiveRecord::Base
  has_many :licenses
  has_many :users, :through => :licenses
  
  named_scope :os, :conditions => { :software_type  => "OS" }
  named_scope :office, :conditions => { :software_type  => "office" }
  
end
