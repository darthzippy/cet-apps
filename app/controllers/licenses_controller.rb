class LicensesController < ApplicationController
  
  def create
    @user = User.find(params[:user_id])
    @license = @user.licenses.build(params[:license])
    @license.updated_by=current_cet_user.display_name
    
    respond_to do |format|
      if @license.save
        flash[:notice] = 'License was succesfully created'
        format.html { redirect_to @user }
      else
        flash[:error] = @license.errors.full_message_to_setence
        format.html { redirect_to @user}
      end
    end  
  end
  
  def destroy
    @user = User.find(params[:user_id])
    @license = @user.licenses.find(params[:id])
    
    @license.destroy
    
    respond_to do |format|
      flash[:notice] = 'License was successfully deleted'
      format.html { redirect_to @user }
      format.js # renders destroy.js.rjs
    end
  end
end
