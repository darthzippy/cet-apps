# == Schema Information
# Schema version: 20090227181628
#
# Table name: cet_users
#
#  id            :integer(4)      not null, primary key
#  login         :string(255)
#  email         :string(255)
#  display_name  :string(255)
#  given_name    :string(255)
#  last_login_at :datetime
#  created_at    :datetime
#  updated_at    :datetime
#

require 'digest/sha1'

class CetUser < ActiveRecord::Base
  has_many :shifts
end
