class User < ActiveRecord::Base
  
  has_many :licenses
  has_many :softwares, :through => :licenses
  
  has_many :checkouts
  has_many :hubs, :through => :checkouts
  
  has_many :hardware_assignments
  has_many :computers, :through => :hardware_assignments
  has_many :departments, :through => :hardware_assignments
  
  named_scope :freshmen, :conditions => { :role => "undergraduate-freshman" }
  named_scope :sophomores, :conditions => { :role => "undergraduate-sohpomore" }
  named_scope :juniors, :conditions => { :role => "undergraduate-junior" }
  named_scope :seniors, :conditions => { :role => "undergraduate-senior" }
  
  named_scope :controller, :conditions => { :department => "Controller's Office"}
  named_scope :faculty_staff, :conditions => { :role => 'faculty', :role => 'employee'} 
  named_scope :ordered, lambda { |*order|
    { :order => order.flatten.first || 'created_at DESC' }
  }
  
  
  def fullname
    "#{last}, #{first} #{middle}"
  end
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['last like ?', "%#{search}%"],
             :order => 'last'
  end
  
  def self.search_by_id(search_by_id, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['id like ?', "%#{search_by_id}%"],
             :order => 'last'
  end
  
end
