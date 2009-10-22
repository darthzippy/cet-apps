# == Schema Information
# Schema version: 20090227181628
#
# Table name: softwares
#
#  id            :integer(4)      not null, primary key
#  name          :string(255)
#  software_type :string(255)
#  created_at    :datetime
#  updated_at    :datetime
#

class Software < ActiveRecord::Base
  has_many :licenses
  has_many :users, :through => :licenses
  
  named_scope :os, :conditions => { :software_type  => "OS" }
  named_scope :office, :conditions => { :software_type  => "office" }
  named_scope :active, :conditions => [ "active = ?", 1]
  
  def is_active?
    if self.active
      "Yes"
    else
      "No"
    end
  end
  
end
