class AddUpdatedbyToLicenses < ActiveRecord::Migration
  def self.up
    add_column :licenses, :updated_by, :string
  end

  def self.down
    remove_column :licenses, :updated_by
  end
end
