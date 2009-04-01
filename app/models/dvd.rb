class Dvd < ActiveRecord::Base
  validates_presence_of :firstname, :on => :create, :message => "can't be blank"
  validates_presence_of :lastname, :on => :create, :message => "can't be blank"
  validates_presence_of :address1, :on => :create, :message => "can't be blank"
  validates_presence_of :city, :on => :create, :message => "can't be blank"
  validates_presence_of :state, :on => :create, :message => "can't be blank"
  validates_presence_of :zip, :on => :create, :message => "can't be blank"
  validates_presence_of :email, :on => :create, :message => "can't be blank"
  validates_presence_of :phone, :on => :create, :message => "can't be blank"
  validates_presence_of :quantity, :on => :create, :message => "can't be blank"
  validates_numericality_of :quantity, :on => :create, :message => "is not a number"
  validates_presence_of :pickup, :on => :create, :message => "can't be blank"
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['lastname like ? OR phone like ?', "%#{search}%", "%#{search}%"],
             :order => 'lastname'
  end
end
