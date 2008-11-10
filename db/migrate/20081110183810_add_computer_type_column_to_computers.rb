class AddComputerTypeColumnToComputers < ActiveRecord::Migration
  def self.up
    add_column :computers, :computer_type, :string
  end

  def self.down
    remove_column :computers, :computer_type
  end
end
