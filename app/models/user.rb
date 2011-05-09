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
  
  def to_s
    "#{last}, #{first} #{middle}"  
  end
  
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
