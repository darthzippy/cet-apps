class Computer < ActiveRecord::Base
  validates_presence_of :control, :on => :create, :message => "can't be blank"
  validates_length_of :control, :within => 5..5, :on => :create, :message => "must be present"
  validates_numericality_of :control, :on => :create, :message => "is not a number"
  validates_uniqueness_of :control, :on => :create, :message => "must be unique"
  
  validates_presence_of :serial, :on => :create, :message => "can't be blank"
  validates_presence_of :model, :on => :create, :message => "can't be blank"
  validates_presence_of :purchase_date, :on => :create, :message => "can't be blank"
  validates_presence_of :purchase_price, :on => :create, :message => "can't be blank"
  
  has_many :hardware_assignments
  has_one :user, :through => :hardware_assignments
  has_one :department, :through => :hardware_assignments
  has_many :comments
  
  named_scope :computer_type, lambda { |computer_type|
      { :conditions => { :computer_type => computer_type } }
    }
  
  named_scope :macs, :conditions => ["computer_type LIKE ?", "%mac%"]
  named_scope :pcs, :conditions => ["computer_type LIKE ?", "%pc%"]
  named_scope :printers, :conditions => ["computer_type LIKE ?", "%printer%"]
  
  named_scope :laptops, :conditions => ["computer_type LIKE ?", "%laptop%"]
  named_scope :desktops, :conditions => ["computer_type LIKE ?", "%desktop%"]
  
  named_scope :ordered, lambda { |*order|
    { :order => order.flatten.first || 'created_at DESC' }
  }
     
  after_update :save_hardware_assignments
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['control like ?', "%#{search}%"],
             :order => 'purchase_date'
  end
  
  def hardware_assignment_attributes=(hardware_assignment_attributes)
    hardware_assignment_attributes.each do |attributes|
      if attributes[:id].blank?
        hardware_assignments.build(attributes)
      else
        hardware_assignment = hardware_assignments.detect { |t| t.id == attributes[:id].to_i }
        hardware_assignment.attributes = attributes
      end
    end
  end
  
  def save_hardware_assignments
    hardware_assignments.each do |h|
      h.save(false)
    end
  end
  
  def warranty_end_date
    purchase_date + (warranty_length*365)
  end
  
end
