class AddUpdatedByToDvds < ActiveRecord::Migration
  def self.up
    add_column :dvds, :updated_by, :string
  end

  def self.down
    remove_column :dvds, :updated_by
  end
end
