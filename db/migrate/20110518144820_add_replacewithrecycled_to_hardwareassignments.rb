class AddReplacewithrecycledToHardwareassignments < ActiveRecord::Migration
  def self.up
    add_column :hardware_assignments, :replace_with_recycled, :boolean
  end

  def self.down
    remove_column :hardware_assignments, :replace_with_recycled
  end
end
