# == Schema Information
# Schema version: 20090227181628
#
# Table name: departments
#
#  id                  :integer(4)      not null, primary key
#  name                :string(255)
#  maintenance_account :string(255)
#  created_at          :datetime
#  updated_at          :datetime
#

class Department < ActiveRecord::Base
  
  has_many :hardware_assignments
  has_many :computers, :through => :hardware_assignments
  has_many :users, :through => :hardware_assignments
  
  named_scope :dept_name, lambda { |dept_name|
     { :conditions => { :name => dept_name } }
  }
  named_scope :controllers_office, :joins => :users, :conditions => [ 'users.department = ?' => "Controller's Office" ]
  
  
  named_scope :ordered1, lambda { |*order|
    { :order => order.flatten.first || 'created_at DESC' }
  }
  
  named_scope :in_inventory, :include => :hardware_assignments, :conditions => [ 'hardware_assignments.inventory2010 = ?', 1]
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['name like ?', "%#{search}%"],
             :order => 'name ASC',
             :include => {:hardware_assignments => :user}
  end
  
  def maintenance_fee_total
    total = 0
    self.computers.each do |c|
      total = (c.maintenance_fee + total)
    end
    total
  end

  def inventory_complete?
    if self.computers.in_inventory.count == 0
      "inventory_incomplete"
    elsif self.computers.count == self.computers.in_inventory.count
      "inventory_complete"
    else
      "inventory_incomplete"
    end
  end
end
