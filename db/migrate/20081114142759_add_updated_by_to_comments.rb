class AddUpdatedByToComments < ActiveRecord::Migration
  def self.up
    add_column :comments, :updated_by, :string
  end

  def self.down
    remove_column :comments, :updated_by
  end
end
