# == Schema Information
# Schema version: 20090227181628
#
# Table name: checkouts
#
#  id         :integer(4)      not null, primary key
#  user_id    :integer(4)
#  hub_id     :integer(4)
#  checkout   :datetime
#  checkin    :datetime
#  created_at :datetime
#  updated_at :datetime
#

class Checkout < ActiveRecord::Base
  belongs_to :user
  belongs_to :hub
  
end
