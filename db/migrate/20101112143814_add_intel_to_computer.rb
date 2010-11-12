class AddIntelToComputer < ActiveRecord::Migration
  def self.up
    add_column :computers, :intel, :boolean
  end

  def self.down
    remove_column :computers, :intel
  end
end
