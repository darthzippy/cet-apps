class Checkout < ActiveRecord::Base
  belongs_to :user
  belongs_to :hub
  
end
