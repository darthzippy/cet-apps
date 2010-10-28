# == Schema Information
# Schema version: 20090227181628
#
# Table name: computers
#
#  id                   :integer(4)      not null, primary key
#  control              :string(255)
#  serial               :string(255)
#  model                :string(255)
#  manufacturer         :string(255)
#  purchase_date        :date
#  purchase_price       :integer(4)
#  purchase_acct        :string(255)
#  status               :string(255)
#  cstatus              :string(255)
#  memory               :integer(4)
#  hard_drive           :integer(4)
#  updated_by           :string(255)
#  created_at           :datetime
#  updated_at           :datetime
#  legacy_user          :string(255)
#  legacy_department    :string(255)
#  legacy_account       :string(255)
#  purchase_month       :integer(4)
#  purchase_day         :integer(4)
#  purchase_year        :integer(4)
#  warranty_length      :integer(4)
#  warranty_end         :integer(4)
#  comment              :text
#  charge               :integer(4)
#  legacy_userid        :string(255)
#  location             :string(255)
#  nuend                :integer(4)
#  nuyear               :integer(4)
#  numonth              :integer(4)
#  nuday                :integer(4)
#  endyear              :integer(4)
#  endday               :integer(4)
#  endmonth             :integer(4)
#  nozero               :integer(4)
#  legacy_dateupdated   :string(255)
#  legacy_userupdated   :string(255)
#  wishmaketype         :string(255)
#  repprioroty          :integer(4)
#  busflag              :integer(4)
#  puracct_old          :string(255)
#  controlyear          :string(255)
#  codedate             :string(255)
#  legacy_primaryuser   :string(255)
#  lookup               :string(255)
#  needupgrade          :string(255)
#  legacy_purchase_date :string(255)
#  override             :string(255)
#  warranty_type        :string(255)
#  os_campagree         :string(255)
#  off_campagree        :string(255)
#  legacy_account_old   :string(255)
#  computer_type        :string(255)
#  part_number          :string(255)
#  cameron_id           :string(255)
#

class Computer < ActiveRecord::Base
  validates_presence_of :control, :on => :create, :message => "can't be blank"
  validates_length_of :control, :within => 5..5, :on => :create, :message => "must be five characters long"
  validates_numericality_of :control, :on => :create, :message => "is not a number"
  validates_uniqueness_of :control, :on => :create, :message => "must be unique"
  
  validates_presence_of :serial, :on => :create, :message => "can't be blank"
  #validates_presence_of :model, :on => :create, :message => "can't be blank"
  validates_presence_of :purchase_date, :on => :create, :message => "can't be blank"
  #validates_presence_of :purchase_price, :on => :create, :message => "can't be blank"
  
  has_many :hardware_assignments
  has_one :user, :through => :hardware_assignments
  has_many :departments, :through => :hardware_assignments
  has_many :comments
  
  accepts_nested_attributes_for :hardware_assignments, :departments, :user, :allow_destroy => true
  
  named_scope :computer_type, lambda { |computer_type|
      { :conditions => { :computer_type => computer_type } }
    }
  
  named_scope :macs, :conditions => ["computer_type LIKE ?", "%mac%"]
  named_scope :pcs, :conditions => ["computer_type LIKE ?", "%pc%"]
  named_scope :printers, :conditions => ["computer_type LIKE ?", "%printer%"]
  
  named_scope :laptops, :conditions => ["computer_type LIKE ?", "%laptop%"]
  named_scope :desktops, :conditions => ["computer_type LIKE ?", "%desktop%"]
  
  named_scope :has_control_number, :conditions => ["NOT (control = ?)", " "]
  named_scope :on_inventory, :include => :departments, :conditions => ["NOT (departments.name LIKE ?)", "%inventory%"]
  named_scope :off_inventory, :include => :departments, :conditions => ["departments.name LIKE ?", "%inventory%"]
  named_scope :in_use, :include => :departments, :conditions => ["NOT (departments.name LIKE ?) AND NOT (departments.name LIKE ?) AND (computer_type LIKE ? OR computer_type LIKE ?)", "%inventory%", "%unassigned%", "%mac%", "%pc%"]
  named_scope :intel, :conditions => ["model LIKE ? OR model LIKE ? OR model LIKE ? OR model LIKE ? OR model LIKE ? OR model LIKE ?", "%intel%", "%core 2%", "%c2d%", "%macbook pro%", "%mac book pro%", "%xeon%"]
  
  named_scope :ordered, lambda { |*order|
    { :include => :user, :order => order.flatten.first || 'users.last ASC' }
  }
     
  #after_update :save_hardware_assignments
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['control like ? OR serial like ?', "%#{search}%", "%#{search}%"],
             :order => 'purchase_date',
             :include => {:hardware_assignments => :user}
  end
  
  def warranty_end_date
    if purchase_date.nil?
    else
      (purchase_date + (warranty_length*365)).to_formatted_s(:long)
    end  
  end
  
  def is_printer?
    if self.computer_type =~ /(p|P)rinter/    
      true
    end
  end
  
  def new_charge
    if computer_type =~ /(l|L)aptop/
      100
    elsif computer_type =~ /(d|D)esktop/
      70
    elsif self.is_printer?
      if computer_type =~ /(c|C)olor/
        150
      else
        100
      end
    else
      0
    end  
  end
  
  def covered_this_year?
    if self.warranty_end_date.nil?
      false
    elsif self.warranty_end_date.to_date > Date.today.end_of_year
      true
    end
  end
  
  def maintenance_fee
    if status =~ /(c|C)/
      if covered_this_year?
        new_charge/2
      else
        new_charge
      end 
    elsif status =~ /(o|O|e|E|p|P)/
      0
    end
  end
end
