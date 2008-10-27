class Hub < ActiveRecord::Base
  validates_uniqueness_of :hub_number, :on => :create, :message => "must be unique"
  validates_presence_of :hub_number, :on => :create, :message => "can't be blank"
  validates_numericality_of :hub_number, :on => :create, :message => "is not a number"
  
  has_many :checkouts
  has_many :users, :through => :checkouts
  
  #getter method
  def user_name
    #user.last if user
    [user.first, user.last].join(' ') if user
  end
  
  #setter method
  def user_name=(name)
    #self.user = User.find_by_last(name) unless last.blank?
    split = name.split(' ', 2)
    self.user.first = split.first
    self.user.last = split.last
  end
end 