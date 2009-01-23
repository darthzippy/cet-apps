class AddPartnumberToComputers < ActiveRecord::Migration
  def self.up
    add_column :computers, :part_number, :string
  end

  def self.down
    remove_column :computers, :part_number
  end
end
