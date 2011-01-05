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
  
  named_scope :total_licenses, :joins  => :licenses,
                               :select => "softwares.*, count(licenses.id) as licenses_count",
                               :group  => "softwares.id",
                               :order  => "software_type DESC, name ASC"
                               
  named_scope :this_year, lambda { { :conditions => [ "licenses.created_at BETWEEN ? AND ?", "2010-08-14 01:00:00", Time.now.utc ] } }
  named_scope :this_semester, lambda { { :conditions => [ "licenses.created_at BETWEEN ? AND ?", "2011-01-01 01:00:00", Time.now.utc ] } }
  
  named_scope :individual_software, lambda { |name| { :conditions => ["name LIKE ?", name] } }
  
  
  def is_active?
    if self.active
      "Yes"
    else
      "No"
    end
  end
  
  def self.chart_data
    data = []
    @software = Software.total_licenses.active
    for software in @software
      data << software.licenses_count.to_i
    end
    data
  end
  
  def self.chart_label
    label = []
    @software = Software.total_licenses.active
    for software in @software
      label << software.name
    end
    label
  end
  
end
