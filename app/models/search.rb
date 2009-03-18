# == Schema Information
# Schema version: 20090227181628
#
# Table name: searches
#
#  id                   :integer(4)      not null, primary key
#  department_id        :integer(4)
#  computer_type        :string(255)
#  min_purdate          :date
#  max_purdate          :date
#  include_offinventory :boolean(1)
#  created_at           :datetime
#  updated_at           :datetime
#  mac_or_pc            :string(255)
#  include_nameless     :boolean(1)
#

class Search < ActiveRecord::Base
  
  def computers
    @computers ||= find_computers
  end
  
  private
  
  def find_computers
    Computer.all(:conditions => conditions, :include => :department)
  end

  def computer_type_conditions
    ["computers.computer_type LIKE ?", "%#{computer_type}%"] unless computer_type.blank?
  end
  
  def mac_or_pc_conditions
    ["computers.computer_type LIKE ?", "%#{mac_or_pc}%"] unless mac_or_pc.blank?
  end
  
  def minimum_purchase_date_conditions
    ["computers.purchase_date >= ?", min_purdate] unless min_purdate.blank?
  end
  
  def maximum_purchase_date_conditions
    ["computers.purchase_date <= ?", max_purdate] unless max_purdate.blank?
  end
  
  def include_nameless_conditions
    ["computers.user is ?", include_nameless_results] unless include_nameless.blank?
  end
  
  def conditions
    [conditions_clauses.join(' AND '), *conditions_options]
  end
  
  def conditions_clauses
    conditions_parts.map { |condition| condition.first }
  end
  
  def conditions_options
    conditions_parts.map { |condition| condition[1..-1] }.flatten
  end
  
  def conditions_parts
    private_methods(false).grep(/_conditions$/).map { |m| send(m) }.compact
  end
  
  def include_nameless_results
    if include_nameless == 1
      not nil
    else
      nil
    end
  end
  
  def dump_csv
    #@computers = Computer.find(:all, :order => "control ASC")
    @outfile = "computers_" + Time.now.strftime("%m-%d-%Y") + ".csv"

    csv_data = FasterCSV.generate do |csv|
      csv << [
      "Control",
      "Model",
      "Serial #",
      ]
      computers.each do |computer|
        csv << [
        computer.control,
        computer.model,
        computer.serial,
        ]
      end
    end

    send_data csv_data,
      :type => 'text/csv; charset=iso-8859-1; header=present',
      :disposition => "attachment; filename=#{@outfile}"

    flash[:notice] = "Export complete!"
  end
end
