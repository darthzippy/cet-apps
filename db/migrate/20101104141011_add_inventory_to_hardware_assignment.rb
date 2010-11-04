class AddInventoryToHardwareAssignment < ActiveRecord::Migration
  def self.up
    add_column :hardware_assignments, :fullorpart, :string
    add_column :hardware_assignments, :dedicated, :string
    add_column :hardware_assignments, :standard, :string
    add_column :hardware_assignments, :special, :string
    add_column :hardware_assignments, :inventory2010, :boolean
    add_column :hardware_assignments, :updated_by, :string
  end

  def self.down
    remove_column :hardware_assignments, :updated_by
    remove_column :hardware_assignments, :inventory2010
    remove_column :hardware_assignments, :special
    remove_column :hardware_assignments, :standard
    remove_column :hardware_assignments, :dedicated
    remove_column :hardware_assignments, :fullorpart
  end
end
