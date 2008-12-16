class Comment < ActiveRecord::Base
  
  belongs_to :computer
  
  named_scope :ordered, lambda { |*order|
    { :order => order.flatten.first || 'created_at DESC' }
  }
  
  def updated_or_created
    self.updated_at || self.created_at
  end
  
end
