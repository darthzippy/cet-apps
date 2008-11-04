class AddLegacyColumnsToComputers < ActiveRecord::Migration
  def self.up
    add_column :computers, :legacy_user, :string
    add_column :computers, :legacy_department, :string
    add_column :computers, :legacy_account, :string
    add_column :computers, :purchase_month, :integer
    add_column :computers, :purchase_day, :integer
    add_column :computers, :purchase_year, :integer
    add_column :computers, :warranty_length, :integer
    add_column :computers, :warranty_end, :integer
    add_column :computers, :comment, :text
    add_column :computers, :charge, :integer
    add_column :computers, :legacy_userid, :string
    add_column :computers, :location, :string
    add_column :computers, :nuend, :integer
    add_column :computers, :nuyear, :integer
    add_column :computers, :numonth, :integer
    add_column :computers, :nuday, :integer
    add_column :computers, :endyear, :integer
    add_column :computers, :endday, :integer
    add_column :computers, :endmonth, :integer
    add_column :computers, :nozero, :integer
    add_column :computers, :legacy_dateupdated, :string
    add_column :computers, :legacy_userupdated, :string
    add_column :computers, :wishmaketype, :string
    add_column :computers, :repprioroty, :integer
    add_column :computers, :busflag, :integer
    add_column :computers, :puracct_old, :string
    add_column :computers, :controlyear, :string
    add_column :computers, :codedate, :string
    add_column :computers, :legacy_primaryuser, :string
    add_column :computers, :lookup, :string
  end

  def self.down
    remove_column :computers, :lookup
    remove_column :computers, :legacy_primaryuser
    remove_column :computers, :codedate
    remove_column :computers, :controlyear
    remove_column :computers, :puracct_old
    remove_column :computers, :busflag
    remove_column :computers, :repprioroty
    remove_column :computers, :wishmaketype
    remove_column :computers, :legacy_userupdated
    remove_column :computers, :legacy_dateupdated
    remove_column :computers, :nozero
    remove_column :computers, :endmonth
    remove_column :computers, :endday
    remove_column :computers, :endyear
    remove_column :computers, :nuday
    remove_column :computers, :numonth
    remove_column :computers, :nuyear
    remove_column :computers, :nuend
    remove_column :computers, :location
    remove_column :computers, :legacy_userid
    remove_column :computers, :charge
    remove_column :computers, :comment
    remove_column :computers, :warranty_end
    remove_column :computers, :warranty_length
    remove_column :computers, :purchase_year
    remove_column :computers, :purchase_day
    remove_column :computers, :purchase_month
    remove_column :computers, :legacy_account
    remove_column :computers, :legacy_department
    remove_column :computers, :legacy_user
  end
end
