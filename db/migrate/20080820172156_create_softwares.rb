class CreateSoftwares < ActiveRecord::Migration
  def self.up
    create_table :softwares do |t|
      t.string :name
      t.string :software_type

      t.timestamps
    end
  end

  def self.down
    drop_table :softwares
  end
end
