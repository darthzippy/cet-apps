module DepartmentsHelper
  
  def inventory_percent
    50/51
  end
  
  def inventory_test
    @computers.in_inventory.count
  end
end
