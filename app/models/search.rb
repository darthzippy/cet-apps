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
  
  def computer_type_conditions
    ["computers.computer_type = ?", computer_type] unless computer_type.blank?
  end
  
  def minimum_purchase_date
    ["computers.purchase_date >= ?", min_purdate] unless min_purdate.blank?
  end
  
  def maximum_purchase_date
    ["computers.purchase_date <= ?", max_purdate] unless max_purdate.blank?
  end
  
  def include_unassigned
    
  end
  
  def conditions
    [conditions_clauses.join(' AND '), *conditions_options]
  end
  
  def conditions_clauses
    conditions_parts.map { |condition| condition.first }
  end
  
  def conditions_options
    conditions_parts.map { |condition| condition[1..-1] }.flatten
  end
  
  def conditions_parts
    private_methods(false).grep(/_conditions$/).map { |m| send(m) }.compact
  end
end
