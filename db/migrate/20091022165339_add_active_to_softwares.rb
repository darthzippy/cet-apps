class AddActiveToSoftwares < ActiveRecord::Migration
  def self.up
    add_column :softwares, :active, :boolean
  end

  def self.down
    remove_column :softwares, :active
  end
end
