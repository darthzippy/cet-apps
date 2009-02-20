class Search < ActiveRecord::Base
  
  def computers
    @computers ||= find_computers
  end
  
  private
  
  def find_computers
    Computer.all(:conditions => conditions)
  end
  
  def department_conditions
    ["computers.department_id = ?", department_id] unless department_id.blank?
  end
end
