# Methods added to this helper will be available to all templates in the application.
module ApplicationHelper
  def shift_for_sidebar
    Shift.first
  end
end
