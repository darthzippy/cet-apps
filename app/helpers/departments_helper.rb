module DepartmentsHelper
  
  def inventory_percent
    (Float(@computers.in_inventory.count)/Float(@computers.count))*100 || 0
  end

end
