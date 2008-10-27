class License < ActiveRecord::Base
  belongs_to :user
  belongs_to :software
  
  named_scope :win_xp_sales, :conditions => { :software_id => 1 }
  named_scope :mac_leopard_sales, :conditions => { :software_id => 2 }
  named_scope :win_office2007_sales, :conditions => { :software_id => 3 }
  named_scope :mac_office2008_sales, :conditions => { :software_id => 4 }
  named_scope :win_vista_sales, :conditions => { :software_id => 5 }
  named_scope :mac_tiger_sales, :conditions => { :software_id => 6 }
  named_scope :mac_office2004_sales, :conditions => { :software_id => 7 }
  named_scope :win_office2003_sales, :conditions => { :software_id => 8 }
  
  named_scope :recent, lambda { { :conditions => [ "created_at BETWEEN ? AND ?", "2008-08-21 01:00:00", Time.now ] } }
  named_scope :alltime
end
