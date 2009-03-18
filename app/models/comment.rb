# == Schema Information
# Schema version: 20090227181628
#
# Table name: comments
#
#  id          :integer(4)      not null, primary key
#  computer_id :integer(4)
#  body        :text
#  created_at  :datetime
#  updated_at  :datetime
#  updated_by  :string(255)
#

class Comment < ActiveRecord::Base
  
  belongs_to :computer
  
  named_scope :ordered, lambda { |*order|
    { :order => order.flatten.first || 'created_at DESC' }
  }
  
  def updated_or_created
    self.updated_at || self.created_at
  end
  
end
