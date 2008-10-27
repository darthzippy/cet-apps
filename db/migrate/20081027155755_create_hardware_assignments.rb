class CreateHardwareAssignments < ActiveRecord::Migration
  def self.up
    create_table :hardware_assignments do |t|
      t.integer :computer_id
      t.integer :user_id
      t.integer :department_id
      t.boolean :primary_computer

      t.timestamps
    end
  end

  def self.down
    drop_table :hardware_assignments
  end
end
