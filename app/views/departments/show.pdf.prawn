pdf.font "Helvetica"

pdf.text "CET Apps Department Report", :size => 16, :style => :bold
pdf.text "#{@department.name}", :size => 24, :style => :bold
pdf.text "Created at #{Time.now.to_formatted_s(:long)} by #{current_cet_user.display_name}"

pdf.move_down(10)

items = @computers.has_control_number.map do |item|
  [
    item.control,
	item.hardware_assignments.first.user,
	item.computer_type,
	item.model,
	item.hardware_assignments.first.assignment_type,
	item.replacement_year,
	item.hardware_assignments.first.replace_with_recycled?
  ]
end

pdf.table items,
  :row_colors         => ["FFFFFF", "DDDDDD"],
  :headers            => ["Control", "Name", "Type", "Model", "Assignment", "Replacement Year", "Recycled?"],
  :align_headers      => :left,
  :font_size          => 9,
  :border_width       => 0.2