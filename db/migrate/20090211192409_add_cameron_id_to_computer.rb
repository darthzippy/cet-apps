class AddCameronIdToComputer < ActiveRecord::Migration
  def self.up
    add_column :computers, :cameron_id, :string
  end

  def self.down
    remove_column :computers, :cameron_id
  end
end
