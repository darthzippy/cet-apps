class AddNextneedToHardwareAssignment < ActiveRecord::Migration
  def self.up
    add_column :hardware_assignments, :nextneed_macpc, :string
    add_column :hardware_assignments, :nextneed_laptopdesktop, :string
    add_column :hardware_assignments, :nextneed_note, :text
  end

  def self.down
    remove_column :hardware_assignments, :nextneed_note
    remove_column :hardware_assignments, :nextneed_laptopdesktop
    remove_column :hardware_assignments, :nextneed_macpc
  end
end
