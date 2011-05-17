class AddReplacementyearToComputers < ActiveRecord::Migration
  def self.up
    add_column :computers, :replacement_year, :string
  end

  def self.down
    remove_column :computers, :replacement_year
  end
end
