# == Schema Information
# Schema version: 20090227181628
#
# Table name: hardware_assignments
#
#  id               :integer(4)      not null, primary key
#  computer_id      :integer(4)
#  user_id          :integer(4)
#  department_id    :integer(4)
#  primary_computer :boolean(1)
#  created_at       :datetime
#  updated_at       :datetime
#

class HardwareAssignment < ActiveRecord::Base
  belongs_to :computer
  belongs_to :department
  belongs_to :user
  
  def assignment_type
    if fullorpart?
      [fullorpart,' ',dedicated,' ',standard,' ',special].join
    else
      "TBD"
    end
  end
end
