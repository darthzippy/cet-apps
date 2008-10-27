class AddOnCampusToUser < ActiveRecord::Migration
  def self.up
    add_column :users, :on_campus, :string
  end

  def self.down
    remove_column :users, :on_campus
  end
end
