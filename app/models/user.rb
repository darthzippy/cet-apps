# == Schema Information
# Schema version: 20090227181628
#
# Table name: users
#
#  id         :integer(4)      not null, primary key
#  first      :string(255)
#  middle     :string(255)
#  last       :string(255)
#  role       :string(255)
#  building   :string(255)
#  room       :integer(4)
#  email      :string(255)
#  phone      :string(255)
#  barcode    :string(255)
#  department :string(255)
#  active     :string(255)
#  created_at :datetime
#  updated_at :datetime
#  gordon_id  :integer(4)
#  on_campus  :string(255)
#

class User < ActiveRecord::Base
  
  has_many :licenses
  has_many :softwares, :through => :licenses
  
  has_many :hardware_assignments
  has_many :computers, :through => :hardware_assignments
  has_many :departments, :through => :hardware_assignments
  
  named_scope :freshmen, :conditions => { :role => "undergraduate-freshman" }
  named_scope :sophomores, :conditions => { :role => "undergraduate-sohpomore" }
  named_scope :juniors, :conditions => { :role => "undergraduate-junior" }
  named_scope :seniors, :conditions => { :role => "undergraduate-senior" }
  
  named_scope :controller, :conditions => { :department => "Controller's Office"}
  named_scope :faculty_staff, :conditions => [ "role LIKE ? OR role LIKE ?", "faculty", "employee" ]
  
  named_scope :ordered, lambda { |*order|
    { :order => order.flatten.first || 'last ASC' }
  }
  named_scope :by_department, lambda { |department|
    { :conditions => { :department => department } }
  }

  
  def fullname
    "#{last}, #{first} #{middle}"
  end
  
  def is_facstaff?
    if self.role == 'faculty'
      true
    elsif self.role == 'employee'
      true
    end
  end
  
  def is_gradstudent?
    if self.role =~ /grad(1|2)/ 
      true
    end
  end
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['last like ?', "%#{search}%"],
             :order => 'last',
             :include => {:softwares => :licenses}
  end
  
  def self.search_by_id(search_by_id, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['id like ?', "%#{search_by_id}%"],
             :order => 'last'
  end
  
end
