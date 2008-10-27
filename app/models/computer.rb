class Computer < ActiveRecord::Base
  validates_presence_of :control, :on => :create, :message => "can't be blank"
  validates_length_of :control, :within => 5..5, :on => :create, :message => "must be present"
  validates_numericality_of :control, :on => :create, :message => "is not a number"
  validates_uniqueness_of :control, :on => :create, :message => "must be unique"
  
  validates_presence_of :serial, :on => :create, :message => "can't be blank"
  validates_presence_of :model, :on => :create, :message => "can't be blank"
  validates_presence_of :purchase_date, :on => :create, :message => "can't be blank"
  validates_presence_of :purchase_price, :on => :create, :message => "can't be blank"
  validates_presence_of :purchse_acct, :on => :create, :message => "can't be blank"
  
  has_many :hardware_assignments
  has_one :user, :through => :hardware_assignment
  has_one :department, :through => :hardware_assignment
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['control like ?', "%#{search}%"],
             :order => 'purchase_date'
  end
  
  def hardware_assignment_attributes=(hardware_assignment_attributes)
    hardware_assignment_attributes.each do |attributes|
      hardware_assignments.build(attributes)
    end
  end
  
end
