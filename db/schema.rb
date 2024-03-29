# This file is auto-generated from the current state of the database. Instead of editing this file, 
# please use the migrations feature of Active Record to incrementally modify your database, and
# then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your database schema. If you need
# to create the application database on another system, you should be using db:schema:load, not running
# all the migrations from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 20110518144820) do

  create_table "cet_users", :force => true do |t|
    t.string   "login"
    t.string   "email"
    t.string   "display_name"
    t.string   "given_name"
    t.datetime "last_login_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "comments", :force => true do |t|
    t.integer  "computer_id"
    t.text     "body"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "updated_by"
  end

  create_table "computers", :force => true do |t|
    t.string   "control"
    t.string   "serial"
    t.string   "model"
    t.string   "manufacturer"
    t.date     "purchase_date"
    t.integer  "purchase_price"
    t.string   "purchase_acct"
    t.string   "status"
    t.string   "cstatus"
    t.integer  "memory"
    t.integer  "hard_drive"
    t.string   "updated_by"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "legacy_user"
    t.string   "legacy_department"
    t.string   "legacy_account"
    t.integer  "purchase_month"
    t.integer  "purchase_day"
    t.integer  "purchase_year"
    t.integer  "warranty_length"
    t.integer  "warranty_end"
    t.text     "comment"
    t.integer  "charge"
    t.string   "legacy_userid"
    t.string   "location"
    t.integer  "nuend"
    t.integer  "nuyear"
    t.integer  "numonth"
    t.integer  "nuday"
    t.integer  "endyear"
    t.integer  "endday"
    t.integer  "endmonth"
    t.integer  "nozero"
    t.string   "legacy_dateupdated"
    t.string   "legacy_userupdated"
    t.string   "wishmaketype"
    t.integer  "repprioroty"
    t.integer  "busflag"
    t.string   "puracct_old"
    t.string   "controlyear"
    t.string   "codedate"
    t.string   "legacy_primaryuser"
    t.string   "lookup"
    t.string   "needupgrade"
    t.string   "legacy_purchase_date"
    t.string   "override"
    t.string   "warranty_type"
    t.string   "os_campagree"
    t.string   "off_campagree"
    t.string   "legacy_account_old"
    t.string   "computer_type"
    t.string   "part_number"
    t.string   "cameron_id"
    t.boolean  "intel"
    t.string   "ip_address"
    t.string   "replacement_year"
  end

  create_table "courses", :force => true do |t|
    t.string   "source"
    t.string   "destination"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "departments", :force => true do |t|
    t.string   "name"
    t.string   "maintenance_account"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "dvds", :force => true do |t|
    t.string   "firstname"
    t.string   "lastname"
    t.string   "address1"
    t.string   "address2"
    t.string   "city"
    t.string   "state"
    t.string   "zip"
    t.string   "email"
    t.string   "phone"
    t.integer  "quantity"
    t.string   "pickup"
    t.boolean  "paid"
    t.date     "paid_date"
    t.string   "paid_with"
    t.boolean  "delivered"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "updated_by"
  end

  create_table "hardware_assignments", :force => true do |t|
    t.integer  "computer_id"
    t.integer  "user_id"
    t.integer  "department_id"
    t.boolean  "primary_computer"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "fullorpart"
    t.string   "dedicated"
    t.string   "standard"
    t.string   "special"
    t.boolean  "inventory2010"
    t.string   "updated_by"
    t.string   "nextneed_macpc"
    t.string   "nextneed_laptopdesktop"
    t.text     "nextneed_note"
    t.boolean  "replace_with_recylced"
  end

  create_table "licenses", :force => true do |t|
    t.integer  "user_id"
    t.integer  "software_id"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "updated_by"
  end

  create_table "searches", :force => true do |t|
    t.integer  "department_id"
    t.string   "computer_type"
    t.date     "min_purdate"
    t.date     "max_purdate"
    t.boolean  "include_offinventory"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "mac_or_pc"
    t.boolean  "include_nameless"
  end

  create_table "shifts", :force => true do |t|
    t.integer  "cet_user_id"
    t.integer  "payperiod_id"
    t.datetime "start_time"
    t.datetime "end_time"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "softwares", :force => true do |t|
    t.string   "name"
    t.string   "software_type"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.boolean  "active"
  end

  create_table "users", :force => true do |t|
    t.string   "first"
    t.string   "middle"
    t.string   "last"
    t.string   "role"
    t.string   "building"
    t.integer  "room"
    t.string   "email"
    t.string   "phone"
    t.string   "barcode"
    t.string   "department"
    t.string   "active"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "gordon_id"
    t.string   "on_campus"
    t.string   "state",      :limit => 11
    t.string   "country",    :limit => 11
    t.string   "zip",        :limit => 11
    t.string   "blank1",     :limit => 11
    t.string   "blank2",     :limit => 11
  end

end
