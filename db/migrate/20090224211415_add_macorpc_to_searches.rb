class AddMacorpcToSearches < ActiveRecord::Migration
  def self.up
    add_column :searches, :mac_or_pc, :string
  end

  def self.down
    remove_column :searches, :mac_or_pc
  end
end
