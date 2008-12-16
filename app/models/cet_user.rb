require 'digest/sha1'
class CetUser < ActiveRecord::Base
  has_many :shifts
end
