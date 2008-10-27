class AddGordonIdToUser < ActiveRecord::Migration
  def self.up
    add_column :users, :gordon_id, :integer
  end

  def self.down
    remove_column :users, :gordon_id
  end
end
