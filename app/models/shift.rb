# == Schema Information
# Schema version: 20090227181628
#
# Table name: shifts
#
#  id           :integer(4)      not null, primary key
#  cet_user_id  :integer(4)
#  payperiod_id :integer(4)
#  start_time   :datetime
#  end_time     :datetime
#  created_at   :datetime
#  updated_at   :datetime
#

class Shift < ActiveRecord::Base
  belongs_to :cet_user
  
  named_scope :current_user_shifts, :conditions => ["cet_user_id = ?", '#{current_cet_user.id}']
end
