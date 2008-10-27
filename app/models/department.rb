class Department < ActiveRecord::Base
  
  has_many :hardware_assignments
  has_many :computers, :through => :hardware_assignments
  has_many :users, :through => :hardware_assignments
  
  named_scope :dept_name, lambda { |dept_name|
     { :conditions => { :name => dept_name } }
  }
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['name like ?', "%#{search}%"],
             :order => 'name'
  end
  
end
