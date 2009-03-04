class AddIncludeNamelessToSearches < ActiveRecord::Migration
  def self.up
    add_column :searches, :include_nameless, :boolean
  end

  def self.down
    remove_column :searches, :include_nameless
  end
end
